/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.uom.kanthaka.preprocessor.rulereader;

/**
 * 
 * @author Makumar
 */

public class CounterConditionFields {

    String conditionName;
    String condition;
    Long value;

    /**
     * 
     * @param 
     * @param 
     * @return
     */
    public CounterConditionFields(String conditionName, String condition, Long value) {
        this.conditionName = conditionName;
        this.condition = condition;
        this.value = value;
    }

    /**
     * 
     * @param 
     * @param 
     * @return
     */
    public String printDetails() {
        return conditionName + " " + condition + " " + value;
    }

    /**
     * 
     * @param 
     * @param 
     * @return
     */
    public String getConditionName() {
        return conditionName;
    }

    /**
     * 
     * @param 
     * @param 
     * @return
     */
    public String getCondition() {
        return condition;
    }

    /**
     * 
     * @param 
     * @param 
     * @return
     */
    public Long getValue() {
        return value;
    }

    /**
     * 
     * @param 
     * @param 
     * @return
     */
    public void setConditionName(String conditionName) {
        this.conditionName = conditionName;
    }

    /**
     * 
     * @param 
     * @param 
     * @return
     */
    public void setCondition(String condition) {
        this.condition = condition;
    }

    /**
     * 
     * @param 
     * @param 
     * @return
     */
    public void setValue(Long value) {
        this.value = value;
    }
}
